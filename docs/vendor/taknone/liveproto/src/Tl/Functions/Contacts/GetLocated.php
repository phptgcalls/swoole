<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgeopoint geo_point true background int self_expires
 * @return Updates
 */

final class GetLocated extends Instance {
	public function request(object $geo_point,? true $background = null,? int $self_expires = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd348bc44);
		$flags = 0;
		$flags |= is_null($background) ? 0 : (1 << 1);
		$flags |= is_null($self_expires) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($geo_point->read());
		if(is_null($self_expires) === false):
			$writer->writeInt($self_expires);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>