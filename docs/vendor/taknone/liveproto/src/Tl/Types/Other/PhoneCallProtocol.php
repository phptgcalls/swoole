<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int min_layer int max_layer Vector<string> library_versions true udp_p2p true udp_reflector
 * @return PhoneCallProtocol
 */

final class PhoneCallProtocol extends Instance {
	public function request(int $min_layer,int $max_layer,array $library_versions,? true $udp_p2p = null,? true $udp_reflector = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfc878fc8);
		$flags = 0;
		$flags |= is_null($udp_p2p) ? 0 : (1 << 0);
		$flags |= is_null($udp_reflector) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($min_layer);
		$writer->writeInt($max_layer);
		$writer->tgwriteVector($library_versions,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['udp_p2p'] = true;
		else:
			$result['udp_p2p'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['udp_reflector'] = true;
		else:
			$result['udp_reflector'] = false;
		endif;
		$result['min_layer'] = $reader->readInt();
		$result['max_layer'] = $reader->readInt();
		$result['library_versions'] = $reader->tgreadVector('string');
		return new self($result);
	}
}

?>