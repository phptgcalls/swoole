<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name string about string description
 * @return bots.BotInfo
 */

final class BotInfo extends Instance {
	public function request(string $name,string $about,string $description) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe8a775b0);
		$writer->tgwriteBytes($name);
		$writer->tgwriteBytes($about);
		$writer->tgwriteBytes($description);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['name'] = $reader->tgreadBytes();
		$result['about'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>