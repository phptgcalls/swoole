<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id true success string error
 * @return Bool
 */

final class SetBotPrecheckoutResults extends Instance {
	public function request(int $query_id,? true $success = null,? string $error = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9c2dd95);
		$flags = 0;
		$flags |= is_null($success) ? 0 : (1 << 1);
		$flags |= is_null($error) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
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