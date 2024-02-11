<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeConfigurationRequest;
use App\Models\Configuration;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Throwable;

class ConfigurationController extends Controller
{
    public function index()
    {
        $allConfigurations = Configuration::latest()->paginate(5);
        return view('configurations.index', compact('allConfigurations'));
    }

    public function create()
    {
        return view('configurations.create');
    }

    public function store(storeConfigurationRequest $storeConfigurationRequest)
    {
         try {
            Configuration::create($storeConfigurationRequest->all());
            return redirect()->route('configurations.index')->with('success_message', 'Configuration Enregistrée.');
         } catch (\Throwable $th) {
            throw $th;
         }
    }

    public function delete(Configuration $configuration) 
    {
        // Suppression d'une configuration
        try {
            $configuration->delete();

            return redirect()->route('configurations.index')->with('success_message', 'Configuration Retirée.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
