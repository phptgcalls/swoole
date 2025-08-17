<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id datajson data
 * @return Bool
 */

final class AnswerWebhookJSONQuery extends Instance {
	public function request(int $query_id,object $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe6213f4d);
		$writer->writeLong($query_id);
		$writer->write($data->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>