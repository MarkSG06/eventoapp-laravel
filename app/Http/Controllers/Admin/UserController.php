<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MySQL\User;
use App\ViewModels\Admin\UserViewModel as ViewModel;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
  
  public function __construct(private User $user){}
  
  public function index()
  {
    try{
      $filters = [
        'name' => 'like',
        'email' => 'like'
      ];

      $query = $this->user;

      foreach ($filters as $field => $type) {
        $value = request($field);

        if ($value === null || $value === '') {
          continue;
        }

        match ($type) {
          'like' => $query->where($field, 'like', '%' . $value . '%'),
          '='    => $query->where($field, $value),
          default => null,
        };
      }

      $users = $query
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();
      
      if(request()->ajax()) {
            
        return response()->json([
          'table' => view('components.tables', ['tableStructure' => ViewModel::tableStructure(), 'records' => $users])->render(),
          'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $this->user])->render()
        ], 200); 

      }else{

        $view = View::make('admin.users.index')
        ->with('tableStructure', ViewModel::tableStructure())
        ->with('formStructure', ViewModel::formStructure())
        ->with('records', $users)
        ->with('record', $this->user);

        return $view;
      }
    }catch(\Exception $e){
      return response()->json([
        'message' =>  $e->getMessage(),  
      ], 500);
    }
  }

  public function create()
  {
    try {
      if (request()->ajax()) {
        return response()->json([
          'form' => view('components.forms', ['formStructure' => $this->user->formStructure(), 'record' => $this->user])->render(),
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
          'message' =>  'hola',
      ], 500);
    }
  }

  public function store(UserRequest $request)
  {            
    try{

      $data = $request->validated();

      unset($data['password_confirmation']);
      
      if (!$request->filled('password') && $request->filled('id')){
        unset($data['password']);
      }
  
      $this->user->updateOrCreate([
        'id' => $request->input('id')
      ], $data);

      $users = $this->user
      ->orderBy('created_at', 'desc')
      ->paginate(10);

      if ($request->filled('id')){
        $message = \Lang::get('admin/notification.update');
      }else{
        $message = \Lang::get('admin/notification.create');
      }
      
      return response()->json([
        'table' => view('components.tables', ['tableStructure' => $this->user->tableStructure(), 'records' => $users])->render(),
        'form' => view('components.forms', ['formStructure' => $this->user->formStructure(), 'record' => $this->user])->render(),
        'message' => $message,
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => $e->getMessage(),
      ], 500);
    }
  }

  public function show(User $user)
  {
    try{
      return response()->json([
        'form' => view('components.forms', ['formStructure' => $this->user->formStructure(), 'record' => $user])->render(),
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => 'hola',
      ], 500);
    }
  }

  public function destroy(User $user)
  {
    try{
      $user->delete();

      $users = $this->user
      ->orderBy('created_at', 'desc')
      ->paginate(10);

      $message = \Lang::get('admin/notification.destroy');
      
      return response()->json([
        'table' => view('components.tables', ['tableStructure' => $this->user->tableStructure(), 'records' => $users])->render(),
        'form' => view('components.forms', ['formStructure' => $this->user->formStructure(), 'record' => $this->user])->render(),
        'message' => $message,
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => 'hola',
      ], 500);
    }
  }
}