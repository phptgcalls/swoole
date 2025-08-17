<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string job_id string phone_number string text
 * @return SmsJob
 */

final class SmsJob extends Instance {
	public function request(string $job_id,string $phone_number,string $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe6a1eeb8);
		$writer->tgwriteBytes($job_id);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['job_id'] = $reader->tgreadBytes();
		$result['phone_number'] = $reader->tgreadBytes();
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>