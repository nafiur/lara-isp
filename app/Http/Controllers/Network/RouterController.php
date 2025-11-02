<?php

namespace App\Http\Controllers\Network;

use App\Http\Controllers\Controller;
use App\Domain\Network\Models\Router;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RouterController extends Controller
{
    public function index(): View
    {
        $routers = Router::query()
            ->orderBy('name')
            ->paginate(15);

        return view('network.routers.index', [
            'routers' => $routers,
        ]);
    }

    public function create(): View
    {
        return view('network.routers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request, isUpdate: false);

        $slug = $this->generateUniqueSlug($data['name']);

        DB::transaction(function () use ($data, $slug, $request) {
            Router::create([
                'name' => $data['name'],
                'slug' => $slug,
                'host' => $data['host'],
                'api_port' => $data['api_port'],
                'username' => $data['username'],
                'password' => $data['password'],
                'connection_type' => $data['connection_type'],
                'use_ssl' => Arr::get($data, 'use_ssl', false),
                'status' => $data['status'],
                'meta' => Arr::get($data, 'meta'),
                'created_by' => $request->user()?->getKey(),
            ]);
        });

        return redirect()
            ->route('network.routers.index')
            ->with('status', __('Router created successfully.'));
    }

    public function edit(Router $router): View
    {
        return view('network.routers.edit', compact('router'));
    }

    public function update(Request $request, Router $router): RedirectResponse
    {
        $data = $this->validateData($request, isUpdate: true);

        if ($router->name !== $data['name']) {
            $router->slug = $this->generateUniqueSlug($data['name'], $router->id);
        }

        $router->fill([
            'name' => $data['name'],
            'host' => $data['host'],
            'api_port' => $data['api_port'],
            'username' => $data['username'],
            'connection_type' => $data['connection_type'],
            'use_ssl' => Arr::get($data, 'use_ssl', false),
            'status' => $data['status'],
            'meta' => Arr::get($data, 'meta'),
        ]);

        if (! empty($data['password'])) {
            $router->password = $data['password'];
        }

        $router->save();

        return redirect()
            ->route('network.routers.index')
            ->with('status', __('Router updated successfully.'));
    }

    public function destroy(Router $router): RedirectResponse
    {
        $router->delete();

        return redirect()
            ->route('network.routers.index')
            ->with('status', __('Router removed successfully.'));
    }

    protected function validateData(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'host' => ['required', 'string', 'max:191'],
            'api_port' => ['required', 'integer', 'min:1', 'max:65535'],
            'username' => ['required', 'string', 'max:120'],
            'password' => [$isUpdate ? 'nullable' : 'required', 'string', 'max:255'],
            'connection_type' => ['required', Rule::in(['api', 'ssh'])],
            'use_ssl' => ['sometimes', 'boolean'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'meta' => ['nullable', 'array'],
        ]);
    }

    protected function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (Router::where('slug', $slug)
            ->when($ignoreId, fn ($query, $id) => $query->whereKeyNot($id))
            ->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
