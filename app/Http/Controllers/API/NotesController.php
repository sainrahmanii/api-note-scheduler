<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotesRequest;
use App\Models\Activity;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $judul = $request->input('judul');
        $star_at = $request->input('star_at');
        $end_at = $request->input('end_at');

        if ($id) 
        {
            $note = Note::with('Activity')->find($id);

            if ($note) 
                return ResponseFormatter::success($note, 'Data berhasil diambil');
            else
                return ResponseFormatter::error(null, 'Data tidak ada', 404);
        }

        if ($judul) 
        {
            $note = Note::with('Activity')
                ->where('judul', $judul)
                ->first();

            if($note)
                return ResponseFormatter::success($note, 'Data berhasil diambil');
            else
                return ResponseFormatter::error(null, 'Data tidak ditemukan');
        }

        $note = Note::with('Activity');

        if ($star_at)
            $note->where('star_at', '>=', $star_at);

        if ($end_at)
            $note->where('end_at', '<=', $end_at);

        return ResponseFormatter::success(
            $note->get(),
            'Data berhasil ditemukan'
        );
    }

    public function activity_id(Request $request)
    {
        $id = $request->input('id');

        if ($id)
        {
            $note = Activity::with('Notes')->find($id);

            if ($note)
                return ResponseFormatter::success($note, 'Data berhasil di temukan');
            else
                return ResponseFormatter::error(null, 'Data tidak ditemukan', 404);
        }
    }

    public function notes(NotesRequest $request)
    {
        $data = $request->all();
        $note = Note::create($data);

        return ResponseFormatter::success($note);
    }

    public function update(NotesRequest $request, $id)
    {
        $judul = $request->judul;
        $star_at = $request->star_at;
        $end_at = $request->end_at;

        $notes = Note::find($id);
        $notes->judul = $judul;
        $notes->star_at = $star_at;
        $notes->end_at = $end_at;
        $notes->save();

        return ResponseFormatter::success($notes, 'Data berhasil di update');
    }

    public function delete($id)
    {
        $notes = Note::find($id);
        $notes->delete();

        return ResponseFormatter::success($notes, 'Data berhasil di hapus');
    }

    public function activity(Request $request, $id)
    {
        $data = $request->all();
        $note = Note::find($id);
        $note->Activity()->create($data);

        return ResponseFormatter::success($note);
    }

    public function UpdateActivity(Request $request, $id)
    {
        $activity = $request->activity;
        
        $notes = Note::find($id);
        $notes = Activity::find($id);
        $notes->activity = $activity;
        $notes->save();

        return ResponseFormatter::success($notes, 'Data berhasil di update');
    }

    public function DeleteActivity($id)
    {
        $notes = Note::find($id);
        $notes = Activity::find($id);
        $notes->delete();

        return ResponseFormatter::success($notes, 'Data berhasil di hapus');
    }
}
