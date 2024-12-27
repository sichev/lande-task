<?php

namespace App\Http\Controllers;

use App\Interfaces\CalculatorInterface;
use App\Models\DistributionModel;
use App\Models\RoundingModel;
use App\Rules\RatesRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistributionController extends Controller
{
    private Request $request;
    private CalculatorInterface $calculator;


    public function __construct(Request $request, CalculatorInterface $calculator)
    {
        $this->request = $request;
        $this->calculator = $calculator;
    }

    public function index()
    {
        return DistributionModel::all();
    }

    public function store()
    {
        $validator = Validator::make($this->request->json()->all(), [
            'amount' => 'required|integer|min:1',
            'rates' => ['required', new RatesRule],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $this->calculator->calculate($validator->getValue('amount'), $validator->getValue('rates'));

        $distribution = DistributionModel::factory()
            ->create($this->prepareDistributionPayload($data));

        RoundingModel::factory()
            ->for($distribution)
            ->create($this->prepareRoundingsPayload($data));


        return $distribution;
    }

    public function roundings()
    {
        return RoundingModel::all();
    }

    private function prepareDistributionPayload(array $data)
    {
        return $this->array_replace_existing([
                'amount' => null,
                'distribution' => [],
            ],
            $data,
        );
    }

    private function prepareRoundingsPayload(array $data)
    {
        return $this->array_replace_existing([
                'total' => null,
                'roundings' => [],
            ],
            $data,
        );
    }

    private function array_replace_existing(array $original, array $replacements): array {
        return array_replace($original, array_intersect_key($replacements, $original));
    }
}
