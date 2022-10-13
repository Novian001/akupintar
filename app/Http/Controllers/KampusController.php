<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Models\Kampus;
use Illuminate\Http\Request;

class KampusController extends Controller
{
    use Helper;

    public function index(Request $request)
    {
        return $this->responseFormatterWithMeta($this->httpCode['StatusOK'], $this->httpMessage['StatusOK'], Kampus::select('id', 'name', 'nik', 'no_passport', 'tanggal_lahir', 'no_rm', 'created_at')->orderBy('created_at', 'desc')->cursorPaginate($request->input('per_page', 15)));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = explode(';', $request->search);

        $kampus = Kampus::select('id', 'name', 'nik', 'no_passport', 'tanggal_lahir', 'no_rm', 'created_at')
                ->WhereIn('nik', $search)
                ->orWhereIn('no_passport', $search);
                foreach ($search as $value) {
                    $kampus->orWhere('name', 'ILIKE', '%' . $value . '%');
                    
                }
        $kampus = $kampus->orderBy('created_at', 'desc')
                ->cursorPaginate($request->input('per_page', 15));

        return $this->responseFormatterWithMeta($this->httpCode['StatusOK'], $this->httpMessage['StatusOK'], $kampus);
    }
}
