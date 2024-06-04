<?php

namespace App\Http\Requests;

use App\Models\Evaluation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EvaluatationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'duree' => 'required|integer|min:1|max:3',
            'groupe_id' => 'required|exists:groupes,id',
            'module_id' => 'required|exists:modules,id',
            'numero_ctrl' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('evaluations')->where(function ($query) {
                    return $query->where('groupe_id', $this->groupe_id)
                                 ->where('module_id', $this->module_id);
                }),
                function ($attribute, $value, $fail) {
                    $lastEvaluation = Evaluation::where('groupe_id', $this->groupe_id)
                                                ->where('module_id', $this->module_id)
                                                ->orderBy('numero_ctrl', 'desc')
                                                ->first();
                    $nextExpectedCtrl = $lastEvaluation ? $lastEvaluation->numero_ctrl + 1 : 1;
                    if ($value != $nextExpectedCtrl) {
                        $fail('Le numéro de contrôle doit suivre la séquence et devrait être ' . $nextExpectedCtrl . '.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'La date de l\'évaluation est obligatoire.',
            'date.date' => 'La date de l\'évaluation doit être une date valide.',
            'duree.required' => 'La durée de l\'évaluation est obligatoire.',
            'duree.integer' => 'La durée de l\'évaluation doit être un nombre entier.',
            'duree.min' => 'La durée de l\'évaluation doit être d\'au moins 1 heure.',
            'duree.max' => 'La durée de l\'évaluation ne peut pas dépasser 3 heures.',
            'numero_ctrl.required' => 'Le numéro de contrôle est obligatoire.',
            'numero_ctrl.unique' => 'Le groupe a déjà passé cette évaluation !',
            'numero_ctrl.min' => 'Le numéro de contrôle doit être commencer par 1 .',
        ];
    }
}
