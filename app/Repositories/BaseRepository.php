<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use MrAtiebatie\Repository;

trait BaseRepository 
{
    use Repository;
    // use Repository;

    /**
     * Get Model Instance
     *
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * With or Without Trash Elements?
     *
     * @param bool $trashed
     * @return mixed
     */
    public function withTrash(bool $trashed = false)
    {
        return ($trashed) ? $this->model->getModel() : $this->model->getModel()->withoutTrashed();
    }

    /**
     * Find Decoding ID
     *
     * @param $id
     * @param bool $trashed
     * @return mixed
     */
    public function findDecoding($id, bool $trashed = false)
    {
        //$model = $this->withTrash($trashed);

        return $this->find(optimus()->decode($id));
    }

    /**
     * Find Encoding ID
     *
     * @param $id
     * @param bool $trashed
     * @return mixed
     */
    public function findEncoding($id, bool $trashed = false)
    {
        //$model = $this->withTrash($trashed);

        return $this->find(optimus()->encode($id));
    }

    /**
     * Find In
     *
     * @param string $inColumn
     * @param array $ids
     * @param bool $trashed
     * @return mixed
     */
    public function findIn($inColumn = 'id', array $ids = [], bool $trashed = false)
    {
        //$model = $this->withTrash($trashed);

        return $this->whereIn($inColumn, $ids)->get();
    }

    /**
     * Find NotIn
     *
     * @param string $inColumn
     * @param array $ids
     * @param bool $trashed
     * @return mixed
     */
    public function findNotIn($inColumn = 'id', array $ids = [], bool $trashed = false)
    {
        //$model = $this->withTrash($trashed);

        return $this->whereNotIn($inColumn, $ids)->get();
    }

    /**
     * Find An Element
     *
     * @param $id
     * @param array $columns
     * @param array $with
     * @param bool $trashed
     * @return mixed
     */
    public function findDecoded($id, array $columns = ['*'], array $with = [], bool $trashed = false)
    {
        //$model = $this->withTrash($trashed);

        return $this
            ->with($with)
            ->find(optimus()->decode($id), $columns);
    }

    /**
     * Find An Element 
     *
     * @param $id
     * @param array $columns
     * @param array $with
     * @param bool $trashed
     * @return mixed
     */
    public function find($id, array $columns = ['*'], array $with = [], bool $trashed = false)
    {
        //$model = $this->withTrash($trashed);

        return $this
            ->with($with)
            ->find($id, $columns);
    }

    /**
     * Find by ajax (select2)
     *
     * @param string $q
     * @return mixed
     */
    public function ajax(string $q)
    {
        return $this
            ->select(['id', 'name as text'])
            ->where('name', 'like', '%' . $q . '%')
            ->where('status', '=', 'active')
            ->whereNull('deleted_at')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Update In
     *
     * @param array $ids
     * @param array $data
     * @param bool $trashed
     * @return mixed
     */
    public function updatedIn(array $ids, array $data, bool $trashed = false)
    {
        //$model = $this->withTrash($trashed);

        return $this->whereIn('id', $ids)->update($data);
    }

    /**
     * Insert or update a record matching the attributes, and fill it with values.
     *
     * @param array $attributes
     * @param array $values
     * @return bool
     */
    public function updateOrInsert(array $attributes, array $values = []): bool
    {
        if (! $this->where($attributes)->exists()) {
            return $this->insert(array_merge($attributes, $values));
        }

        if (empty($values)) {
            return true;
        }

        if ($this->hasColumn('updated_at')) {
            $values = array_merge($values, ['updated_at' => now()]);
        }

        return boolean($this->where($attributes)->first()->update($values));
    }

    /**
     * Soft Delete In
     *
     * @param string $inColumn
     * @param array $ids
     * @param bool $trashed
     * @return mixed
     */
    public function softDelete($inColumn = 'id', array $ids = [], bool $trashed = false)
    {
        //$model = $this->withTrash($trashed);

        return $this->whereIn($inColumn, $ids)->delete();
    }

    /**
     * Check Filter Exists
     *
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function filterExists($query, $filters)
    {
        if (count($filters) > 0) {
            $request = request();
            // dd( $request->input());

            foreach ($filters as $filter) {
                // Filter exists?
                if (! $request->has($filter) || $request->get($filter) === null) {
                    continue;
                }

                // Input Field Value
                $input_filter = $request->get($filter);

                // Status
                if ($filter === 'status') {
                    $query = $query->where('status', '=', $input_filter);
                    continue;
                }

                // User
                if ($filter === 'user_id') {
                    $input_filter = $input_filter === 'null' ? null : $input_filter;
                    $query = $query->where('user_id', '=', $input_filter);
                    continue;
                }

                // Departamento
                if ($filter === 'departemento') {
                    $input_filter = $input_filter === 'null' ? null : $input_filter;
                    $query = $query->where('Departamento', '=', $input_filter);
                    continue;
                }

                // Departamento
                if ($filter === 'tipo_practica') {
                    $input_filter = $input_filter === 'null' ? null : $input_filter;
                    $query = $query->where('tipoPractica', '=', $input_filter);
                    continue;
                }
                
                // Date Range
                if ($filter === 'date_range') {
                    $dates = explode(' - ', $input_filter);

                    if (count($dates) === 2) {
                        $query = $query
                            ->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', $dates[0]))
                            ->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', $dates[1]));
                    }

                    continue;
                }

                $query = $query->where($filter, '=', $input_filter);
            }
        }

        return $query;
    }

    /**
     * Base: DataTable Query
     *
     * @param array $filters
     * @return mixed
     */
    public function dataTables(array $filters = [])
    {
        $query = $this->newQuery()
            //->withTrashed()
            ->select(['*']);

        $query = $this->filterExists($query, $filters);

        return $query;
    }

    /**
     * Base: Count this repository for widget
     *
     * @return mixed
     */
    public function widget()
    {
        return $this
            ->where('status', '=', 'active')
            ->count();
    }

    /**
     * Base: Get Status Distinct
     *
     * @param array $with
     * @return mixed
     */
    public function statuses($with = [])
    {
        return $this::with($with)
            ->select('status')
            ->groupBy('status')
            ->orderBy('status', 'asc')
            ->get();
    }

    /**
     * Base: Get Menu Types actives
     *
     * @param array $with
     * @return mixed
     */
    public function actives($with = [])
    {
        return $this
            ->with($with)
            ->where('status', '=', 1)
            ->get();
    }

    /**
     * Facultad
     */
    public function activosPorPermiso($permiso)
    {
        $repository = $this->where('status', 1);
        if(!allows_permission($permiso)){
            $repository = $repository->where('id', auth()->user()->departamento);
        }
        return $repository;
    }

    /**
     * Update Multiple Values
     *
     * @param array $data
     * @param string $key_column
     * @param string $value_column
     * @return int
     */
    public function bulkUpdate(array $data, string $key_column, string $value_column): int
    {
        // Table name
        $table          = $this->getModel()->getTable();

        // Where In
        $columns        = '\'' . implode(
            '\', \'',
            array_map(static function ($value) {
                    return $value;
            }, array_keys($data))
        ) . '\'';

        // Build Cases
        $cases          = [];
        foreach ($data as $k => $v) {
            $k          = \DB::connection()->getPdo()->quote($k);
            $v          = \DB::connection()->getPdo()->quote($v);
            $cases[]    = "WHEN `{$key_column}` = {$k} THEN {$v} ";
        }

        $cases          = implode('', $cases);

        // Updates
        $auth_user_id   = \DB::connection()->getPdo()->quote(auth()->user()->id);
        $now            = \DB::connection()->getPdo()->quote(now()->format('Y-m-d H:i:s'));

        return \DB::update("UPDATE `{$table}` SET `{$value_column}` = CASE {$cases} END, `updated_by` = {$auth_user_id}, `updated_at` = {$now} WHERE `{$key_column}` IN ({$columns})", $data);
    }
}
