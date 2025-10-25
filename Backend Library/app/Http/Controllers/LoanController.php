<?php
namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the loans.
     */
    public function index()
    {
        $loans = Loan::with(['member', 'book'])->get();
        return response()->json($loans, 200);
    }

    /**
     * Store a newly created loan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date',
        ]);

        $loan = Loan::create($request->all());
        return response()->json($loan->load(['member', 'book']), 201);
    }

    /**
     * Display the specified loan.
     */
    public function show($id)
    {
        $loan = Loan::with(['member', 'book'])->findOrFail($id);
        return response()->json($loan, 200);
    }

    /**
     * Update the specified loan.
     */
    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        
        $request->validate([
            'member_id' => 'sometimes|required|exists:members,id',
            'book_id' => 'sometimes|required|exists:books,id',
            'loan_date' => 'sometimes|required|date',
            'return_date' => 'nullable|date',
        ]);

        $loan->update($request->all());
        return response()->json($loan->load(['member', 'book']), 200);
    }

    /**
     * Remove the specified loan.
     */
    public function destroy($id)
    {
        Loan::destroy($id);
        return response()->json(null, 204);
    }
}