<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbotinlinemessageid id inputuser user_id int score true edit_message true force
 * @return Bool
 */

final class SetInlineGameScore extends Instance {
	public function request(object $id,object $user_id,int $score,? true $edit_message = null,? true $force = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x15ad9f64);
		$flags = 0;
		$flags |= is_null($edit_message) ? 0 : (1 << 0);
		$flags |= is_null($force) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($id->read());
		$writer->write($user_id->read());
		$writer->writeInt($score);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>