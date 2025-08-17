<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> id bytes option string message
 * @return ReportResult
 */

final class Report extends Instance {
	public function request(object $peer,array $id,string $option,string $message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfc78af9b);
		$writer->write($peer->read());
		$writer->tgwriteVector($id,'int');
		$writer->tgwriteBytes($option);
		$writer->tgwriteBytes($message);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>