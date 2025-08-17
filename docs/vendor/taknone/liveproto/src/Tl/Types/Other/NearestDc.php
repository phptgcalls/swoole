<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string country int this_dc int nearest_dc
 * @return NearestDc
 */

final class NearestDc extends Instance {
	public function request(string $country,int $this_dc,int $nearest_dc) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8e1a1775);
		$writer->tgwriteBytes($country);
		$writer->writeInt($this_dc);
		$writer->writeInt($nearest_dc);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['country'] = $reader->tgreadBytes();
		$result['this_dc'] = $reader->readInt();
		$result['nearest_dc'] = $reader->readInt();
		return new self($result);
	}
}

?>