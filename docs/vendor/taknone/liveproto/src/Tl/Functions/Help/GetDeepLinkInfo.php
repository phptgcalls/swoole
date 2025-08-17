<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string path
 * @return help.DeepLinkInfo
 */

final class GetDeepLinkInfo extends Instance {
	public function request(string $path) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3fedc75f);
		$writer->tgwriteBytes($path);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>