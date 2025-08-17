<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url int expires
 * @return ExportedContactToken
 */

final class ExportedContactToken extends Instance {
	public function request(string $url,int $expires) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x41bf109b);
		$writer->tgwriteBytes($url);
		$writer->writeInt($expires);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['expires'] = $reader->readInt();
		return new self($result);
	}
}

?>