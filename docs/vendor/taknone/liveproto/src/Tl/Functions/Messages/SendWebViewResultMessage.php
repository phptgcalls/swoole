<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string bot_query_id inputbotinlineresult result
 * @return WebViewMessageSent
 */

final class SendWebViewResultMessage extends Instance {
	public function request(string $bot_query_id,object $result) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa4314f5);
		$writer->tgwriteBytes($bot_query_id);
		$writer->write($result->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>