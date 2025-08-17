<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id datajson data int timeout
 * @return Update
 */

final class UpdateBotWebhookJSONQuery extends Instance {
	public function request(int $query_id,object $data,int $timeout) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9b9240a6);
		$writer->writeLong($query_id);
		$writer->write($data->read());
		$writer->writeInt($timeout);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['query_id'] = $reader->readLong();
		$result['data'] = $reader->tgreadObject();
		$result['timeout'] = $reader->readInt();
		return new self($result);
	}
}

?>