<?php

namespace PlacetoPay\AppVersion\Tests\Commands;

use PlacetoPay\AppVersion\Tests\TestCase;
use PlacetoPay\AppVersion\VersionFile;

class CreateVersionFileCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        VersionFile::delete();
    }

    /** @test */
    public function can_create_version_file()
    {
        $input = [
            'sha' => 'abcdef',
            'time' => '20200315170330',
            'branch' => 'master',
        ];

        $this->artisan('app-version:create', [
            '--sha' => $input['sha'],
            '--time' => $input['time'],
            '--branch' => $input['branch'],
        ])->assertExitCode(0);

        $this->assertTrue(VersionFile::exists());
        $this->assertEquals(VersionFile::read(), $input);
    }

    /** @test */
    public function can_create_version_file_without_project_variable()
    {
        $input = [
            'sha' => 'abcdef',
            'time' => '20200315170330',
            'branch' => 'master',
        ];

        $this->artisan('app-version:create', [
            '--sha' => $input['sha'],
            '--time' => $input['time'],
            '--branch' => $input['branch'],
        ])->assertExitCode(0);

        $this->assertTrue(VersionFile::exists());
        $this->assertEquals(VersionFile::read(), $input);
    }

    protected function tearDown(): void
    {
        VersionFile::delete();
        parent::tearDown();
    }
}
