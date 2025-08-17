<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputgeopoint geo_point string address
 * @return Bool
 */

final class EditLocation extends Instance {
	public function request(object $channel,object $geo_point,string $address) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x58e63f6d);
		$writer->write($channel->read());
		$writer->write($geo_point->read());
		$writer->tgwriteBytes($address);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>