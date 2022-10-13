<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Models\Kampus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KampusController extends Controller
{
    use Helper;

    public function index(Request $request)
    {
        return $this->responseFormatterWithMeta($this->httpCode['StatusOK'], $this->httpMessage['StatusOK'], Kampus::select('id', 'name', 'akreditas', 'status', 'sum_prodi', 'alamat', 'profil', 'sejarah', 'tipe', 'mengikuti', 'rank', 'created_at')->orderBy('created_at', 'desc')->cursorPaginate($request->input('per_page', 15)));
    }

    public function list()
    {
        return $this->responseFormatter($this->httpCode['StatusOK'], $this->httpMessage['StatusOK'], Kampus::select('id', 'jurusan', 'status', 'created_at', 'updated_at')->orderBy('created_at', 'desc')->get());
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = explode(';', $request->search);

        $kampus = Kampus::select('id', 'name', 'akreditas', 'status', 'tipe', 'rank', 'created_at')
                ->WhereIn('akreditas', $search);
                foreach ($search as $value) {
                    $kampus->orWhere('name', 'ILIKE', '%' . $value . '%');
                    
                }
        $kampus = $kampus->orderBy('created_at', 'desc')
                ->cursorPaginate($request->input('per_page', 15));

        return $this->responseFormatterWithMeta($this->httpCode['StatusOK'], $this->httpMessage['StatusOK'], $kampus);
    }
    public function follow(){
        $follow = DB::table('kampus')->orderByRaw('created_at ASC')->where('status', false)->first();

        $follows = Kampus::where('id', $follow->id)->update([
            'status' => true
        ]);

        $following = Kampus::find($follows->id);

        return $this->responseFormatter($this->httpCode['StatusCreated'], $this->httpMessage['StatusCreated'], $following);
    }
    public function unfollow(){
        $unfollow = DB::table('kampus')->orderByRaw('created_at ASC')->where('status', true)->first();

        $unfollows = Kampus::where('id', $unfollow->id)->update([
            'status' => false
        ]);

        $unfollowing = Kampus::find($unfollows->id);

        return $this->responseFormatter($this->httpCode['StatusCreated'], $this->httpMessage['StatusCreated'], $unfollowing);
    }

}
