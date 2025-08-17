<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson data
 * @return Update
 */

final class UpdateBotWebhookJSON extends Instance {
	public function request(object $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8317c0c3);
		$writer->write($data->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['data'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>