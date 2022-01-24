<?php

namespace App\Interfaces;

Interface TaskInterface
{

    public function store($attributes);

    public function destroy($id);

    public function edit($task_user_id);

    public function update($attributes, $id);

}
