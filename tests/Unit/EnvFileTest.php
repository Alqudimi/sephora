<?php

namespace Tests\Unit;

use App\Support\EnvFile;
use RuntimeException;
use Tests\TestCase;

class EnvFileTest extends TestCase
{
    private string $tempPath;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tempPath = sys_get_temp_dir().'/test_env_'.uniqid().'.env';
    }

    protected function tearDown(): void
    {
        if (file_exists($this->tempPath)) {
            unlink($this->tempPath);
        }
        parent::tearDown();
    }

    public function test_reading_and_getting_values(): void
    {
        file_put_contents($this->tempPath, implode("\n", [
            'APP_NAME="Sephora UAE"',
            'APP_ENV=local',
            '# APP_DEBUG=false',
            'DB_PORT=3306',
        ]));

        $env = new EnvFile($this->tempPath);

        $this->assertTrue($env->exists());
        $this->assertSame('Sephora UAE', $env->get('APP_NAME'));
        $this->assertSame('local', $env->get('APP_ENV'));
        $this->assertSame('3306', $env->get('DB_PORT'));
        $this->assertNull($env->get('MISSING_KEY'));
        $this->assertSame('default_val', $env->get('MISSING_KEY', 'default_val'));
    }

    public function test_updating_existing_keys(): void
    {
        file_put_contents($this->tempPath, "APP_ENV=local\nAPP_DEBUG=true\n");

        $env = new EnvFile($this->tempPath);
        $env->set('APP_ENV', 'production');
        $env->set('APP_DEBUG', 'false');

        $this->assertSame('production', $env->get('APP_ENV'));
        $this->assertSame('false', $env->get('APP_DEBUG'));
    }

    public function test_uncommenting_commented_key(): void
    {
        file_put_contents($this->tempPath, "# APP_FORCE_HTTPS=true\n");

        $env = new EnvFile($this->tempPath);
        $env->set('APP_FORCE_HTTPS', 'true');

        $content = file_get_contents($this->tempPath);
        $this->assertStringNotContainsString('# APP_FORCE_HTTPS', $content);
        $this->assertSame('true', $env->get('APP_FORCE_HTTPS'));
    }

    public function test_appending_missing_key(): void
    {
        file_put_contents($this->tempPath, "APP_NAME=TestApp\n");

        $env = new EnvFile($this->tempPath);
        $env->set('NEW_VARIABLE', 'hello_world');

        $this->assertSame('hello_world', $env->get('NEW_VARIABLE'));
    }

    public function test_set_many_keys(): void
    {
        file_put_contents($this->tempPath, "VAR1=a\nVAR2=b\n");

        $env = new EnvFile($this->tempPath);
        $env->setMany([
            'VAR1' => 'alpha',
            'VAR2' => 'beta',
            'VAR3' => 'gamma with spaces',
        ]);

        $this->assertSame('alpha', $env->get('VAR1'));
        $this->assertSame('beta', $env->get('VAR2'));
        $this->assertSame('gamma with spaces', $env->get('VAR3'));
    }

    public function test_render_quotes_values_with_special_chars(): void
    {
        $safe = EnvFile::render('KEY', 'simple_value_123');
        $this->assertSame('KEY=simple_value_123', $safe);

        $withSpaces = EnvFile::render('KEY', 'value with spaces');
        $this->assertSame('KEY="value with spaces"', $withSpaces);

        $withQuotes = EnvFile::render('KEY', 'has "quotes"');
        $this->assertSame('KEY="has \\"quotes\\""', $withQuotes);
    }

    public function test_read_on_non_existent_file_throws_exception(): void
    {
        $env = new EnvFile('/non/existent/path/for/env');
        $this->assertFalse($env->exists());

        $this->expectException(RuntimeException::class);
        $env->read();
    }
}

