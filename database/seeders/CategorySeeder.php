<?php

namespace Database\Seeders;

use GeneralKnowledgeTrivia\Domain\Category\Category;
use GeneralKnowledgeTrivia\Domain\Category\ValueObjects\CategoryId;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

/**
 * Class CategorySeeder
 *
 * @package Database\Seeders
 */
final class CategorySeeder extends Seeder
{
    private const BASE_CATEGORIES = __DIR__ . '/categories.json';

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws InvalidUuid
     */
    public function run()
    {
        $this->createBaseCategories();
    }

    /**
     * @return void
     * @throws InvalidUuid
     */
    private function createBaseCategories(): void
    {
        if(!file_exists(self::BASE_CATEGORIES)) {
            Log::info("Base categories file not found");
            return;
        }

        $categories = json_decode(
            file_get_contents(self::BASE_CATEGORIES),
            true,
        );

        collect($categories)->each(function ($Category) {

            $CategoryId = new CategoryId(data_get($Category,'uuid'));

            $CategoryAttributes = array_merge([
                'uuid' => $CategoryId
            ], $Category);

            Category::create($CategoryAttributes);
        });
    }
}
