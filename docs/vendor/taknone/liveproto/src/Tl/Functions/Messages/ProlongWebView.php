<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputuser bot long query_id true silent inputreplyto reply_to inputpeer send_as
 * @return Bool
 */

final class ProlongWebView extends Instance {
	public function request(object $peer,object $bot,int $query_id,? true $silent = null,? object $reply_to = null,? object $send_as = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb0d81a83);
		$flags = 0;
		$flags |= is_null($silent) ? 0 : (1 << 5);
		$flags |= is_null($reply_to) ? 0 : (1 << 0);
		$flags |= is_null($send_as) ? 0 : (1 << 13);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->write($bot->read());
		$writer->writeLong($query_id);
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		if(is_null($send_as) === false):
			$writer->write($send_as->read());
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