<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int hash jsonvalue config
 * @return help.AppConfig
 */

final class AppConfig extends Instance {
	public function request(int $hash,object $config) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdd18782e);
		$writer->writeInt($hash);
		$writer->write($config->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readInt();
		$result['config'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>