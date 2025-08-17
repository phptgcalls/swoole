<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes random_id peer peer string sponsor_info string additional_info
 * @return SponsoredPeer
 */

final class SponsoredPeer extends Instance {
	public function request(string $random_id,object $peer,? string $sponsor_info = null,? string $additional_info = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc69708d3);
		$flags = 0;
		$flags |= is_null($sponsor_info) ? 0 : (1 << 0);
		$flags |= is_null($additional_info) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($random_id);
		$writer->write($peer->read());
		if(is_null($sponsor_info) === false):
			$writer->tgwriteBytes($sponsor_info);
		endif;
		if(is_null($additional_info) === false):
			$writer->tgwriteBytes($additional_info);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['random_id'] = $reader->tgreadBytes();
		$result['peer'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['sponsor_info'] = $reader->tgreadBytes();
		else:
			$result['sponsor_info'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['additional_info'] = $reader->tgreadBytes();
		else:
			$result['additional_info'] = null;
		endif;
		return new self($result);
	}
}

?>