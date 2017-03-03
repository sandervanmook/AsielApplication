<?php

use Phinx\Migration\AbstractMigration;

class BackendBundleBookkeepingSettings extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */

    public function up()
    {
        $singleRow = [
            'id' => 1,
            'price_adopted_kitten' => 150,
            'price_adopted_cat' => 120,
            'price_adopted_puppy' => 250,
            'price_adopted_dog' => 185,
            'dog_unaffiliated_younger_than_one' => 45,
            'dog_unaffiliated_older_than_one' => 65,
            'dog_unaffiliated_puppy' => 18,
            'dog_unaffiliated_addition_not_chipped' => 30,
            'dog_unaffiliated_addition_not_vaccinated' => 20,
            'dog_unaffiliated_addition_fur_treatment_small_dog' => 45,
            'dog_unaffiliated_addition_fur_treatment_large_dog' => 100,
            'dog_unaffiliated_addition_ill' => 35,
            'dog_affiliated_younger_than_one' => 30,
            'dog_affiliated_older_than_one' => 50,
            'dog_affiliated_puppy' => 10,
            'dog_affiliated_addition_not_chipped' => 15,
            'dog_affiliated_addition_not_vaccinated' => 15,
            'dog_affiliated_addition_fur_treatment_small_dog' => 35,
            'dog_affiliated_addition_fur_treatment_large_dog' => 80,
            'dog_affiliated_addition_ill' => 35,
            'cat_unaffiliated_younger_than_three_months' => 20,
            'cat_unaffiliated_between_three_months_and_ten_years' => 30,
            'cat_unaffiliated_older_than_ten_years' => 40,
            'cat_unaffiliated_kitten' => 10,
            'cat_unaffiliated_addition_not_chipped' => 20,
            'cat_unaffiliated_addition_not_vaccinated' => 15,
            'cat_unaffiliated_addition_needs_sterilization' => 20,
            'cat_affiliated_younger_than_three_months' => 10,
            'cat_affiliated_between_three_months_and_ten_years' => 15,
            'cat_affiliated_older_than_ten_years' => 25,
            'cat_affiliated_kitten' => 5,
            'cat_affiliated_addition_not_chipped' => 15,
            'cat_affiliated_addition_not_vaccinated' => 15,
            'cat_affiliated_addition_needs_sterilization' => 15,
            'price_found_fee' => 75,
            'price_found_not_chipped' => 42,
            'price_found_not_vaccinated' => 18,
            'price_found_de_worm' => 10,
            'price_found_tenancy_per_day' => 18.15,
            'iban' => 'BE01 1111 2222 3333',
            'bic' => 'BICCODE',
            'invoice_email_address' => 'demo@demo.com'
        ];

        $table = $this->table('backend_bookkeeping_settings');
        $table->insert($singleRow);
        $table->saveData();
    }

    public function down()
    {
        $this->dropTable('AsielApplication.backend_bookkeeping_settings');
    }
}
