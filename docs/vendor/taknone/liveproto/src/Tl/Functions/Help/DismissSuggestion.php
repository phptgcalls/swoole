<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string suggestion
 * @return Bool
 */

final class DismissSuggestion extends Instance {
	public function request(object $peer,string $suggestion) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf50dbaa1);
		$writer->write($peer->read());
		$writer->tgwriteBytes($suggestion);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>