<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Smsjobs;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string job_id
 * @return SmsJob
 */

final class GetSmsJob extends Instance {
	public function request(string $job_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x778d902f);
		$writer->tgwriteBytes($job_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>