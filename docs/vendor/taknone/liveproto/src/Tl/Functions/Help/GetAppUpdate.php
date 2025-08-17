<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string source
 * @return help.AppUpdate
 */

final class GetAppUpdate extends Instance {
	public function request(string $source) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x522d5a7d);
		$writer->tgwriteBytes($source);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>