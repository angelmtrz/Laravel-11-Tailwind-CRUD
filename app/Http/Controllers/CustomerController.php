<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$customers = Customer::paginate(10);
        $query = Customer::query();
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('document', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        $customers = $query->paginate(10);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:natural,juridica',
            'document' => ['required', 'string', 'max:11', 'unique:customers,document',
                        function ($attribute, $value, $fail) use ($request) {
                            if ($request->type === 'natural' && !preg_match('/^10/', $value)) {
                                $fail('El documento debe comenzar con 10 para tipos naturales.');
                            }
                            if ($request->type === 'juridica' && !preg_match('/^20/', $value)) {
                                $fail('El documento debe comenzar con 20 para tipos jurídicos.');
                            }
                        }
                    ],
            'company_name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:natural,juridica',
            'document' => ['required','string', 'max:11',
                            Rule::unique('customers', 'document')->ignore($customer->id),
                            function ($attribute, $value, $fail) use ($request) {
                                if ($request->type === 'natural' && !preg_match('/^10/', $value)) {
                                    $fail('El documento debe comenzar con 10 para tipos naturales.');
                                }
                                if ($request->type === 'juridica' && !preg_match('/^20/', $value)) {
                                    $fail('El documento debe comenzar con 20 para tipos jurídicos.');
                                }
                            }
                        ],
            'company_name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $customer->update($request->all());
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if ($customer->sales()->count() > 0) {
            return redirect()->route('customers.index')->with('error', 'No se puede eliminar el cliente '. $customer->document .' porque tiene ventas asociadas.');
        }

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Cliente eliminado!.');
    }
}
