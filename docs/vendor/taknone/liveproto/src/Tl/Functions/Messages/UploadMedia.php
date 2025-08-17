<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputmedia media string business_connection_id
 * @return MessageMedia
 */

final class UploadMedia extends Instance {
	public function request(object $peer,object $media,? string $business_connection_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x14967978);
		$flags = 0;
		$flags |= is_null($business_connection_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($business_connection_id) === false):
			$writer->tgwriteBytes($business_connection_id);
		endif;
		$writer->write($peer->read());
		$writer->write($media->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>