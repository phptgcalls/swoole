<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string command string description
 * @return BotCommand
 */

final class BotCommand extends Instance {
	public function request(string $command,string $description) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc27ac8c7);
		$writer->tgwriteBytes($command);
		$writer->tgwriteBytes($description);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['command'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>