<?php

use Phinx\Migration\AbstractMigration;

class BackendBundleFrontendSettings extends AbstractMigration
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
            'name' => 'Demo Asiel',
            'address' => 'Demostraat',
            'housenumber' => '1',
            'municipality' => 'Demogemeente',
            'zipcode' => '1111 AA',
            'phone' => '01234- 56789',
            'email' => 'demo@demo.com',
            'coc_number' => '12345678',
            'url' => 'http://www.asielpro.nl',
            'facebook' => 'http://www.facebook.com',
            'logo_filename' => 'default_logo.jpg',
            'about_us' => '<p>Informatie over het asiel</p>'
        ];

        $table = $this->table('backend_frontend_settings');
        $table->insert($singleRow);
        $table->saveData();
    }

    public function down()
    {
        $this->dropTable('AsielApplication.backend_frontend_settings');
    }
}
