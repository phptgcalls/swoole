<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int msg_id true delete_message true delete_history true report_spam
 * @return Updates
 */

final class BlockFromReplies extends Instance {
	public function request(int $msg_id,? true $delete_message = null,? true $delete_history = null,? true $report_spam = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x29a8962c);
		$flags = 0;
		$flags |= is_null($delete_message) ? 0 : (1 << 0);
		$flags |= is_null($delete_history) ? 0 : (1 << 1);
		$flags |= is_null($report_spam) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>