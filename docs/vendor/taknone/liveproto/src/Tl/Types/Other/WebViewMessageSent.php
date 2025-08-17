<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbotinlinemessageid msg_id
 * @return WebViewMessageSent
 */

final class WebViewMessageSent extends Instance {
	public function request(? object $msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc94511c);
		$flags = 0;
		$flags |= is_null($msg_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($msg_id) === false):
			$writer->write($msg_id->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['msg_id'] = $reader->tgreadObject();
		else:
			$result['msg_id'] = null;
		endif;
		return new self($result);
	}
}

?>