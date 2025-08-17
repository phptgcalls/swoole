<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<CdnPublicKey> public_keys
 * @return CdnConfig
 */

final class CdnConfig extends Instance {
	public function request(array $public_keys) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5725e40a);
		$writer->tgwriteVector($public_keys,'CdnPublicKey');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['public_keys'] = $reader->tgreadVector('CdnPublicKey');
		return new self($result);
	}
}

?>