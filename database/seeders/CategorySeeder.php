<?php

namespace Database\Seeders;

use GeneralKnowledgeTrivia\Domain\Category\Category;
use GeneralKnowledgeTrivia\Domain\Category\CategoryId;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

/**
 * Class CategorySeeder
 *
 * @package Database\Seeders
 */
final class CategorySeeder extends Seeder
{
    private const BASE_CATEGORIES_PATH = __DIR__ . '/categories.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createBaseCategories();
    }

    /**
     * @return void
     */
    private function createBaseCategories(): void
    {
        if(!file_exists(self::BASE_CATEGORIES_PATH)) {
            Log::info("Base categories json file not found");
            return;
        }

        $categories = json_decode(
            file_get_contents(self::BASE_CATEGORIES_PATH),
            true,
        );

        collect($categories)->each(function ($Category) {
            Category::create([
               'uuid' => (new CategoryId())->value(),
               ...$Category,
           ]);
        });
    }
}
