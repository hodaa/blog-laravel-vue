<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use App\Models\Category;
use Illuminate\Database\Seeder;

class AddCategories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Category::insert([
            ['name' => 'Politic'],
            ['name' => 'Fashion'],
            ['name' => 'Sport'],
            ['name' => 'Social'],
        ]);
    }
}
