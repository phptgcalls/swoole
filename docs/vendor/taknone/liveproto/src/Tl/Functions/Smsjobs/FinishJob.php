<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Smsjobs;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string job_id string error
 * @return Bool
 */

final class FinishJob extends Instance {
	public function request(string $job_id,? string $error = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4f1ebf24);
		$flags = 0;
		$flags |= is_null($error) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($job_id);
		if(is_null($error) === false):
			$writer->tgwriteBytes($error);
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