<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use FTP;
use Session;

use App\produto;
use App\texto;

class StoreController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function LojaLista(){
		$produto = produto::where('excluido','=','0')
		->where('visivel','=','1')
		->orderby('nome','asc')
		->get();

		$propaganda = texto::where('excluido','=','0')
		->where('visivel','=','1')
		->where('localizacao','=','4')
		->orderby('data','desc')
		->get();

		foreach($produto as $item){
			$item->valor = number_format($item->valor, 2, ',', '.');
		}

		return view('pages.loja',[

			'produto'=>$produto,
			'propaganda'=>$propaganda

			]);

	}

	public function LojaDetalhe($id){
		$produto = produto::where('excluido','=','0')
		->where('id','=',$id)
		->where('visivel','=','1')
		->orderby('nome','asc')
		->get();

		$propaganda = texto::where('excluido','=','0')
		->where('visivel','=','1')
		->where('localizacao','=','4')
		->orderby('data','desc')
		->get();

		foreach($produto as $item){
			$item->valor = number_format($item->valor, 2, ',', '.');
			$item->largura = number_format($item->largura, 2, ',', '.');
			$item->altura = number_format($item->altura, 2, ',', '.');
			$item->profundidade = number_format($item->profundidade, 2, ',', '.');
			$item->peso = number_format($item->peso, 2, ',', '.');
		}

		return view('pages.loja_detalhe',[

			'produto'=>$produto,
			'propaganda'=>$propaganda

			]);

	}

	public function CadastrarProduto(Request $req){

		$produto = new produto();

		$nome = $req->input('nome');
		$valor = $req->input('valor');
		$largura = $req->input('largura');
		$altura = $req->input('altura');
		$profundidade = $req->input('profundidade');
		$peso = $req->input('peso');
		$descricao = $req->input('descricao');
		$autor = $req->input('autor');
		$imagem = $req->file('imagem')->getClientOriginalName();

		$imagem = 'img/'.$imagem;

		$valor = str_replace(",", ".", $valor);
		$largura = str_replace(",", ".", $largura);
		$altura = str_replace(",", ".", $altura);
		$profundidade = str_replace(",", ".", $profundidade);
		$peso = str_replace(",", ".", $peso);

		$data = array(
			'nome'=>$nome,
			'valor'=>$valor,
			'largura'=>$largura,
			'altura'=>$altura,
			'profundidade'=>$profundidade,
			'peso'=>$peso,
			'descricao'=>$descricao,
			'autor'=>$autor,
			'imagem'=>$imagem

			);

		$produto->insert($data);

		if($_FILES["imagem"]["error"] > 0){
			$file_result .= "No file upload or invalid file";
			$file_result .= "Error code: ".$_FILES["imagem"]["error"]."<br>";

			dd($file_result);
		}
		else{

			move_uploaded_file($_FILES["imagem"]["tmp_name"], "img/".$_FILES["imagem"]["name"]);
		}

		return back();
	}

	public function deletarProduto($id){

		$produto = new produto();

		$produto->excluido = 1;

		$produto->save();

		return back();

	}

	public function verProduto($id){

		$produto = produto::find($id);

		if($produto->visivel == 1){
			$produto->visivel = 0;
		}
		else{
			$produto->visivel = 1;
		}

		$produto->save();

		return back();

	}

	public function editarProduto($id){

		$produto = new produto();

		$item = $produto
		->where('id','=',$id)
		->limit(1)
		->get();

		$item_salvos = $produto
		->where('excluido','=','0')
		->where('localizacao','=','1')
		->orderby('data','asc')
		->get();
		
		return view('painel.assuntoedit',[
			'item'=>$item,
			'item_salvos'=>$item_salvos
			]);
	}

	public function painelProduto(){

		$produto = produto::where('excluido','=','0')
		->orderby('nome','asc')
		->get();

		return view('painel.produto',[

			'produto'=>$produto

			]);
	}

	public function addProdutoCarrinho(Request $request, $id){

		$collection = collect([]);

		$qtd = 1;

		$value = Session::get('cart');

		if($value != null){

			$value = Session::get('cart');

			$counter = 0;

			foreach($value as $item){

				if($item->productID == $id){

					$counter++;
				}
			}


			if($counter <=0){

				$data = '{"productID":'.$id.', "qtd":'.$qtd.'}';

				$obj = json_decode($data);

				$request->session()->push('cart', $obj);
			}

		}
		else{
			$request->session()->put('cart', []);

			$data = '{"productID":'.$id.', "qtd":'.$qtd.'}';

			$obj = json_decode($data);

			$request->session()->push('cart', $obj);

		}

		return redirect('carrinho');

	}

	public function removerProdutoCarrinho(Request $request, $id){

		$value = Session::get('cart');

		$index = 0;


		Session::flush();

		$request->session()->put('cart', []);

		foreach($value as $item){
			if($item->productID == $id){
				unset($value[$index]);
			}
			else{
				$request->session()->push('cart', $item);
			}
			$index++;
		}

		return redirect('carrinho');

	}

	public function LojaCarrinho(){

		$value = Session::get('cart');

		$data = [];

		$produto = produto::where('excluido','=','0')
		->where('visivel','=','1')
		->orderby('nome','asc')
		->get();

		if($value != null){
			foreach($produto as $items){

				foreach ($value as $id) {
					if($items->id == $id->productID){
						$data = array_merge($data,array($items));
					}
				}

			}
		}

		

		$propaganda = texto::where('excluido','=','0')
		->where('visivel','=','1')
		->where('localizacao','=','4')
		->orderby('data','desc')
		->get();

		$valortotal = 0.0;

		foreach($data as $item){
			$valortotal += $item->valor;
		}

		

		return view('pages.carrinho',[

			'produto'=>$data,
			'propaganda'=>$propaganda,
			'valortotal' =>$valortotal

			]);

	}

	public function finalizar(){		

		$propaganda = texto::where('excluido','=','0')
		->where('visivel','=','1')
		->where('localizacao','=','4')
		->orderby('data','desc')
		->get();

		

		return view('pages.cadastro',[

			'propaganda'=>$propaganda,

			]);
	}




}
