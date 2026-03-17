<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\ViewModels\Admin\TestingViewModel as ViewModel;
use Illuminate\Http\Request;
use App\Models\MongoDB\Testing;
use App\Http\Requests\Admin\TestingRequest;

class TestingController extends Controller
{
  public function __construct(private Testing $testing)
  {
  }
 
  public function index()
  {
    try{
      $filters = [
        'text' => 'like',
      ];

      $query = $this->testing;

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

      $testings = $query
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();
      
      if(request()->ajax()) {
          
        return response()->json([
          'table' => view('components.tables', ['tableStructure' => ViewModel::tableStructure(), 'records' => $testings])->render(),
          'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $this->testing])->render()
        ], 200); 

      }else{
        $view = View::make('admin.testing.index')
        ->with('tableStructure', ViewModel::tableStructure())
        ->with('formStructure', ViewModel::formStructure())
        ->with('records', $testings)
        ->with('record', $this->testing);
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
          'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $this->testing])->render(),
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
          'message' =>  $e->getMessage(),
      ], 500);
    }
  }

  public function store(TestingRequest $request)
  {            
    try{

      $request->validated();
      $data = $request->all();
      $data['_id'] = $request->input('id');

      $testing = $this->testing->updateOrCreate([
        'id' => $request->input('id')
      ], $data);

      $testings = $this->testing
        ->orderBy('created_at', 'desc')
        ->paginate(10);

      $message = \Lang::get('admin/notification.saved');

      return response()->json([
        'table' => view('components.tables', [
          'tableStructure' => ViewModel::tableStructure(),
          'records' => $testings
        ])->render(),

        'form' => view('components.forms', [
          'formStructure' => ViewModel::formStructure(),
          'record' => $this->testing
        ])->render(),

        'message' => $message,
      ], 200);

    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 422);
    }  
  }

  public function show(Testing $testing)
  {
    try{
      return response()->json([
        'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $testing])->render(),
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => $e->getMessage(),
      ], 500);
    }
  }

  public function destroy(Testing $testing)
  {
    try{
      $testing->delete();

      $testings = $this->testing
      ->orderBy('created_at', 'desc')
      ->paginate(10);

      $message = \Lang::get('admin/notification.destroy');
      
      return response()->json([
        'table' => view('components.tables', ['tableStructure' => ViewModel::tableStructure(), 'records' => $testings])->render(),
        'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $this->testing])->render(),
        'message' => $message,
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => $e->getMessage(),
      ], 500);
    }
  }
}