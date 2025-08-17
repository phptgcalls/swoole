<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string message Vector<MessageEntity> entities
 * @return messages.WebPagePreview
 */

final class GetWebPagePreview extends Instance {
	public function request(string $message,? array $entities = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x570d6f6f);
		$flags = 0;
		$flags |= is_null($entities) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
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