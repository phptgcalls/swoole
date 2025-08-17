<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int dc_id string public_key
 * @return CdnPublicKey
 */

final class CdnPublicKey extends Instance {
	public function request(int $dc_id,string $public_key) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc982eaba);
		$writer->writeInt($dc_id);
		$writer->tgwriteBytes($public_key);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dc_id'] = $reader->readInt();
		$result['public_key'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>