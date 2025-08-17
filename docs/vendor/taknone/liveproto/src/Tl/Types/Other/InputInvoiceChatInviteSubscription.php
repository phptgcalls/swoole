<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string hash
 * @return InputInvoice
 */

final class InputInvoiceChatInviteSubscription extends Instance {
	public function request(string $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x34e793f1);
		$writer->tgwriteBytes($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>