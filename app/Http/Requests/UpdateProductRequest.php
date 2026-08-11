<?php

namespace App\Http\Requests;

use App\Models\Producto;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'       => ['required', 'string', 'max:120'],
            'descripcion'  => ['nullable', 'string', 'max:500'],
            'precio'       => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0', $this->reglaStockConEstado()],
            'imagen'       => ['nullable', 'string', 'max:255'],
            'estado'       => ['required', Rule::in([Producto::ESTADO_DISPONIBLE, Producto::ESTADO_AGOTADO])],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ];
    }

    private function reglaStockConEstado(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail): void {
            if (request('estado') === Producto::ESTADO_DISPONIBLE && $value <= 0) {
                $fail('Un producto "Disponible" debe tener stock mayor a 0.');
            }
        };
    }

    public function messages(): array
    {
        return [
            'nombre.required'       => 'El nombre del producto es obligatorio.',
            'precio.numeric'        => 'El precio debe ser un valor numérico.',
            'precio.min'            => 'El precio no puede ser negativo.',
            'stock.min'             => 'El stock no puede ser negativo.',
            'estado.in'             => 'El estado debe ser Disponible o Agotado.',
            'categoria_id.required' => 'Debés elegir una categoría.',
            'categoria_id.exists'   => 'La categoría seleccionada no existe.',
        ];
    }
}
