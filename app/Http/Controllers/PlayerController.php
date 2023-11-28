<?php

namespace App\Http\Controllers;
use App\Models\Player;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PlayerController extends Controller


{

    public function index() {
		$players=Player::paginate(4);
        return view('index',compact('players'));

	
		
	}

	
    

	public function add() {
		return view('addplayer');
	}
	
	public function Showplayer() {
		$players=Player::paginate(5);
		return view('table_player',compact('players'));

	}


	public function store(Request $request) {
		$file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);
		
		$playerData = [
		'name' => $request->name, 
		'position' => $request->position, 
		'age' => $request->age, 
		'deteils' => $request->deteils, 
		'avatar' =>  $fileName];
	 $result=Player::create($playerData);
	 if($result){
		return response()->json(array('status' => 200,'Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8',JSON_UNESCAPED_UNICODE));
	 }else{
		return response()->json(array('status' => 400,'Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8',JSON_UNESCAPED_UNICODE));
	 }
			
	}
	


	public function update(Request $request,$id) {
		$fileName = '';
		$play = Player::find($request->id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($play->avatar) {
				Storage::delete('public/images/' . $play->avatar);
			}
		} else {
			$fileName = $play->avatar;
		}

		$playerData = [
			'name' => $request->name, 
			'position' => $request->position, 
			'age' => $request->age, 
			'deteils' => $request->deteils, 
			'avatar' => $fileName];
			


			DB::table('players')->where('id', $id)->update($playerData);
	
			 if ($playerData) {
				return response()->json(array('status' => 200));			
		}else{
		return response()->json( [
			'status' => 400,
			'players'=> 'No records Found'
		],400);
	}
}
	


	public function edit(Request $request,$id) {
		$id = $request->id;
		$play = Player::find($id);
		return view('editplayer',compact('play')); response()->json($play);
	}
	
	public function delete(Request $request,$id)
    {
		$id = $request->id;
		$play = Player::find($id);
		if (Storage::delete('public/images/' . $play->avatar)) {
			Player::destroy($id);
		}
		return back();
    }



	





		// Api function
		public function apiindex() {
			$players = Player::all();
			if($players->count() > 0){
				
				return response()->json($players, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
				JSON_UNESCAPED_UNICODE);
			}else{
				return response()->json( [
					'status' => 404,
					'players'=> 'No records Found'
				],404);
			}
	
		
	
		}
		
		public function apistore(Request $request) {
	
				$validator = Validator::make($request->all(),[
					'name'=> 'required',
					'position'=> 'required',
					'age'=> 'required',
					'deteils'=> 'required',
					'avatar'=> 'required'
				]);
			 
			
		
		 if($validator->fails()){
			return response()->json( [
				'status'=> 422,
				'errors' => $validator->messages(),
			],422) ;
		 }
		 else{
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			$players = Player::create([
					'name'=> $request->name,
					'position'=> $request->position,
					'age'=> $request->age,
					'deteils'=> $request->deteils,
					'avatar' =>  $fileName
	
			]);
			if($players){
				return response()->json([
					'status' => 200,
					'message'=> 'Add Successfully'
				],200);
			 }else{
				return response()->json([
					'status' => 500,
					'message'=> 'Something is wrong'
				],500);
			 }
		 }
	
		 
		}

		public function show($id) {
			$player = Player::find($id);
			if($player){
				return response()->json([
					'status' => 200,
					'message'=> $player
				]);
			
			}else{
				return response()->json([
					'status' => 404,
					'message'=> 'No Foud Players'
				]);
			}
		}

		public function editapi($id) {
			$player = Player::find($id);
			if($player){
				return response()->json([
					'status' => 200,
					'message'=> $player
				]);
			
			}else{
				return response()->json([
					'status' => 404,
					'message'=> 'No Foud Players'
				]);
			}
		}



		public function updateapi(Request $request, int $id) { 
			
			$validator = Validator::make($request->all(),[
				'name'=> 'required',
				'position'=> 'required',
				'age'=> 'required',
				'deteils'=> 'required',
				'avatar'=> 'required'
			]);
		 
		
	
	 if($validator->fails()){

		return response()->json( [
			'status'=> 422,
			'errors' => $validator->messages(),
		],422) ;
	 }

	 else{
		$fileName = '';
		$play = Player::find($request->id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($play->avatar) {
				Storage::delete('public/images/' . $play->avatar);
			}
		} else {
			$fileName = $play->avatar;
		}
		$players = Player::find($id);
		$players ->update([
				'name'=> $request->name,
				'position'=> $request->position,
				'age'=> $request->age,
				'deteils'=> $request->deteils,
				'avatar' =>  $fileName

		]);
		if($players){
			return response()->json([
				'status' => 200,
				'message'=> 'Update Successfully'
			],200);
		 }else{
			return response()->json([
				'status' => 500,
				'message'=> ' Update Something is wrong'
			],404);
		 }
	 }



		}

		 public function destroy( $id){


			$players = Player::find($id);
			if($players){
				$players->delete();
				return response()->json([
					'status' => 200,
					'message'=> ' OK OK OK'
				],404);
			 }else{
				return response()->json([
					'status' => 404,
					'message'=> ' No Such Student Found!'
				],404);
			 }
		 }




public function updateapi1(Request $request, $id) { 
		

		$data = $request->validate([
			'name' => 'nullable',
			'position' => 'nullable',
			'age' => 'nullable',
			'deteils	' => 'nullable',
			'avatar' => 'nullable'

		]);
		$player = Player::find($id);

		if($player){
			$fileName = '';
			$play = Player::find($request->id);
			if ($request->hasFile('avatar')) {
				$file = $request->file('avatar');
				$fileName = time() . '.' . $file->getClientOriginalExtension();
				$file->storeAs('public/images', $fileName);
				if ($play->avatar) {
					Storage::delete('public/images/' . $play->avatar);
				}
			} else {
				$fileName = $play->avatar;
				
			}
			
			$player->update($data);
			return response()->json([
				'status' => 200,
				'message' => 'Player Update',
				'data' => $player
			],200);
		}elseif (!$player){
			return response()->json([
				'status' => false,
				'message' => 'Error',
				
			], 404);
		}

		}

		}


 



