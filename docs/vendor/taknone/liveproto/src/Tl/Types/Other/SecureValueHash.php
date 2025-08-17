<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securevaluetype type bytes hash
 * @return SecureValueHash
 */

final class SecureValueHash extends Instance {
	public function request(object $type,string $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xed1ecdb0);
		$writer->write($type->read());
		$writer->tgwriteBytes($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadObject();
		$result['hash'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>