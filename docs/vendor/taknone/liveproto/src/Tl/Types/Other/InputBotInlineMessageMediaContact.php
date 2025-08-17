<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string first_name string last_name string vcard replymarkup reply_markup
 * @return InputBotInlineMessage
 */

final class InputBotInlineMessageMediaContact extends Instance {
	public function request(string $phone_number,string $first_name,string $last_name,string $vcard,? object $reply_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa6edbffd);
		$flags = 0;
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		$writer->tgwriteBytes($vcard);
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['phone_number'] = $reader->tgreadBytes();
		$result['first_name'] = $reader->tgreadBytes();
		$result['last_name'] = $reader->tgreadBytes();
		$result['vcard'] = $reader->tgreadBytes();
		if($flags & (1 << 2)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		return new self($result);
	}
}

?>