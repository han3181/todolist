<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Metode untuk menampilkan daftar tugas
    public function index()
    {
        // Ambil tugas yang terkait dengan pengguna yang sedang login
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks', compact('tasks'));
    }

    // Metode untuk menyimpan tugas baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Membuat tugas baru dengan user_id
        Task::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);

        Session::flash('success', 'Task added successfully!');
        return redirect()->route('tasks.index');
    }

    // Metode untuk menghapus tugas
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        Session::flash('success', 'Task deleted successfully!');
        return redirect()->route('tasks.index');
    }

    // Metode untuk mengupdate tugas
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Mencari tugas berdasarkan ID
        $task = Task::findOrFail($id);

        // Memperbarui judul dan status completed
        $task->title = $request->input('title'); // Memperbarui judul
        $task->completed = $request->has('completed'); // Memperbarui status completed
        $task->save(); // Menyimpan perubahan

        Session::flash('success', 'Task updated successfully!');
        return redirect()->route('tasks.index');
    }
}
